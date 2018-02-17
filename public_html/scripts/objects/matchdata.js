class MatchData
{
  constructor(match_number, team_number, scout, dead, dead_shortly, data)
  {
    this.match_number = match_number;
    this.team_number = team_number;
    
    this.scout = scout;
    
    this.dead = dead;
    this.dead_shortly = dead_shortly;
    
    this.data = data;
  }
  
  equals(matchData)
  {
    if(this.match_number == matchData.match_number && this.team_number == matchData.team_number)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
