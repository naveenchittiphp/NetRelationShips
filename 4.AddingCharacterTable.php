Add New class > Character 
This character has only one user 

namespace EFCoreRelationship
{
    public class Character
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string RpgClass { get; set; } = "Knight";
        public User User { get; set; }
        public int UserId { get; set; }
    }
}


the user has many list of characters 

namespace EFCoreRelationship
{
    public class User
    {
        public int Id { get; set; }
        public string Name { get; set; } = String.Empty;
        public List<Character> Characters { get; set; }

    }
}

  Now add Character to DbContext 
  Add-Migration UserCharacterRelation
          
   Update-Database -Verbose
          
