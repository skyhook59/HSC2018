

SELECT  p.username
		, count (p.pick) AS Total_Picks
		, sum(if(p.pick = l.favTeam,1,0)) AS Num_of_Fav_Pick
		, sum(if(p.pick = l.dogTeam,1,0)) AS Num_of_Dog_Pick
		, sum(if(p.pick = l.homeTeam,1,0)) AS Num_of_Home_Pick
		, sum(if(p.pick = l.favTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Fav_Home_Pick
		
		FROM `Picks` p LEFT JOIN `Lines` l ON p.gameID = l.gameID WHERE username = "MCPHEE" and p.week =9
		
		
		
		SELECT  p.username
		, count(p.pick) AS Total_Picks
		, sum(if(p.pick = l.favTeam,1,0)) AS Num_of_Fav_Pick
		, sum(if(p.pick = l.dogTeam,1,0)) AS Num_of_Dog_Pick
		, sum(if(p.pick = l.homeTeam,1,0)) AS Num_of_Home_Pick
		, sum(if(p.pick = l.favTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Fav_Home_Pick
		, sum(if(p.pick = l.dogTeam, if(p.pick = l.homeTeam,1,0),0)) AS Num_of_Dog_Home_Pick
		
		FROM `Picks` p LEFT JOIN `Lines` l ON p.gameID = l.gameID WHERE username = "MCPHEE"
        GROUP BY p.week
        
        // how to display?
        // can i used picksview and included only winners vs. picks?
        