Lets click on controller folder and add a new controller 

now in constructor pass an aurtment dataContext of datatype  DataContext 
and assign to a property _dataContext of datatype DataContext 

using EFCoreRelationship.Data;
using Microsoft.AspNetCore.Mvc;

namespace EFCoreRelationship.Controllers
{
    public class CharacterController : Controller
    {   
        private readonly DataContext _context;
        public CharacterController(DataContext dataContext)
        {
            _context = dataContext;
          /While adding DataContext we have to use EFCoreRelationship.Data;
        }

        [HttpGet]
        public async Task<ActionResult<List<Character>>> Get(int userId)
        {
          //To use ToListAsync methods we have to globilaze the 
            var characters = await _context.Characters.Where(c => c.UserId == userId).ToListAsync();

        }

    }

   
}


Now add a new method to get all the characters here we are using get method and asyc 
          put Microsoft.EntityFrameworkCore; on top and globilaze that.
          global using Microsoft.EntityFrameworkCore;
