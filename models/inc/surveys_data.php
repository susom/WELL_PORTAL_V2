<?php
//Some Heavier Required Scripts Holding Up Pageload.  Run Here.
//THEN STUFF THEM IN THE SESSION
if(empty($pid)){
	//CORE SURVEY DATA
	// markPageLoadTime("BEGIN  _SESSION[user_survey_data]");
	if(isset($_SESSION["user_survey_data"])){
		//THE BULK OF IT HAS BEEN CALLED ONCE, NOW JUST REFRESH THE NECESSARY DATA
		// markPageLoadTime("BEGIN REFRESH user_survey_data");
		$user_survey_data = $_SESSION["user_survey_data"];
		$user_survey_data->refreshData();
		// markPageLoadTime("END REFRESH user_survey_data");
	}else{
        $api_url 	= $_CFG->REDCAP_API_URL;
        $api_token 	= $_CFG->REDCAP_API_TOKEN;
        $sesh_name 	= SESSION_NAME;

		$user_survey_data = new Project($loggedInUser, $sesh_name, $api_url, $api_token);
		$user_survey_data->refreshData();
		$_SESSION["user_survey_data"] 	= $user_survey_data;
		// WILL NEED TO REFRESH THIS WHEN SURVEY SUBMITTED OR ELSE STALE DATA 
	}

	//THIS DATA NEEDS TO BE REFRESHED EVERYTIME OR RISK BEING STALE 
	$surveys 				= $user_survey_data->getActiveAll();
	$all_completed 			= $user_survey_data->getAllComplete(); 
	$first_survey 			= reset($surveys);

	//THESE ONLY NEED DATA CALL ONCE PER SESSION
	$all_branching 			= $user_survey_data->getAllInstrumentsBranching();
	$core_surveys_complete 	= $user_survey_data->getUserActiveComplete();
	$all_survey_keys  		= array_keys($surveys); 
	// markPageLoadTime("END  _SESSION[user_survey_data]");
}else{
	// markPageLoadTime("BEGIN  _SESSION[supplemental_surveys]");
	//SUPPLEMENTAL PROJECTS
	$supp_instruments  = array();
	if(!$core_surveys_complete){
		// IF NOT COMPLETE THEN JUST GET THE STUB DATA
		if(isset($_SESSION["supplemental_surveys"])){
			$supp_instruments  = $_SESSION["supplemental_surveys"];
		}else{
			$extra_params = array(
				'content' 	=> 'project',
			);
			$proj_name 	= "Supp"; 
			$result 	= RC::callApi($extra_params, true, SurveysConfig::$projects[$proj_name]["URL"], SurveysConfig::$projects[$proj_name]["TOKEN"]);
			$supp_instruments  = array();
			foreach(SurveysConfig::$supp_surveys as $supp_instrument_id => $supp_label){
				$supp_instruments[$supp_instrument_id] = array(  "project_notes" 	=> $result["project_notes"]
																,"project" 			=> $proj_name
																,"label" 			=> $supp_label
																,"survey_complete" 	=> false
														);
			}
			$_SESSION["supplemental_surveys"] = $supp_instruments;
		}	
	}else{
		$all_branching = array();
		if(isset($_SESSION["supplemental_surveys"]) && array_key_exists("Supp",$_SESSION["supplemental_surveys"]) ){
			//THE BULK OF IT HAS BEEN CALLED ONCE, NOW JUST REFRESH THE NECESSARY DATA
			$supp_surveys  = $_SESSION["supplemental_surveys"];
			// markPageLoadTime("BEGIN REFRESH supplemental_surveys");
			foreach($supp_surveys as $supp_survey){
				$supp_survey->refreshData();
				$supp_branching 	= $supp_survey->getAllInstrumentsBranching();
				$all_branching 		= array_merge($all_branching,$supp_branching);
			}
			// markPageLoadTime("END REFRESH supplemental_surveys");
		}else{
			$proj_name 	 				= "Supp";
			$supp_surveys 				= array();
			$supplementalProject 		= new Project($loggedInUser, $proj_name, SurveysConfig::$projects[$proj_name]["URL"], SurveysConfig::$projects[$proj_name]["TOKEN"]);
			$suppsurveys 				= $supplementalProject->getActiveAll();
			$supp_branching 			= $supplementalProject->getAllInstrumentsBranching();
			if(!empty($supp_branching)){
				$all_branching 			= array_merge($all_branching,$supp_branching);
			}
			$supp_surveys[$proj_name] 	= $supplementalProject;

			$_SESSION["supplemental_surveys"] 	= $supp_surveys;
			// WILL NEED TO REFRESH THIS WHEN SURVEY SUBMITTED OR ELSE STALE DATA 
		}
		$supp_instruments = array();
		foreach($_SESSION["supplemental_surveys"] as $projname => $supp_project){
			$supp_instruments 	= array_merge( $supp_instruments,  $supp_project->getActiveAll() );
		} 

		$all_completed = array_filter($user_arm_answers);
	}
	// markPageLoadTime("END  _SESSION[supplemental_surveys]");
}
?>