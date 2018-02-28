class Match
{
  constructor(match_number, time, red_1, red_2, red_3, blue_1, blue_2, blue_3) 
  {
    this.match_number = match_number;
    this.time = time;
    
    this.red_1 = red_1;
    this.red_2 = red_2;
    this.red_3 = red_3;
    this.blue_1 = blue_1;
    this.blue_2 = blue_2;
    this.blue_3 = blue_3;
  }
  
  getMatchData()
  {
    var matchdata = {
      red1: getMatchData(this.match_number, this.red_1),
      red2: getMatchData(this.match_number, this.red_2),
      red3: getMatchData(this.match_number, this.red_3),
      blue1: getMatchData(this.match_number, this.blue_1),
      blue2: getMatchData(this.match_number, this.blue_2),
      blue3: getMatchData(this.match_number, this.blue_3),
    }
    return matchdata;
  }
}
