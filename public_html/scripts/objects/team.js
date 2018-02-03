class Team
{
  constructor(number, name, pit_notes, averages)
  {
    this.number = number;
    this.name = name;
    
    this.pit_notes = pit_notes;
    
    this.averages = averages;
  }
  
  print()
  {
    return this.averages;
  }
}
