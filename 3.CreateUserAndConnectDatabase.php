Lets create a new user class 

namespace EFCoreRelationship
{
    public class User
    {
        public int Id { get; set; }
        public string Name { get; set; } = String.Empty;
    }
}

-----------------------------------------------------------------

Connect to database 

lets opne data / DbContext file and add user to DbContext 

public DbSet<User> users { get; set; }
  
  Now add this Users entity to the migrations by following command 
  
 1) Add-Migration UserEntity -> it will adds the UserEntity to our project
  
   2) Script-Migration -> it will show the script running while build 
  3)Update-Database -Verbose -> It will update the database 
  

