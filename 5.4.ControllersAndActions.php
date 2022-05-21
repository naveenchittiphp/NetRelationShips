End Point : 
------------
exampl.com/generes 

In this url generes is called as end point.


Action:
-------
The method we called is called as action.
Controller is contains group of actions.

Nomeclature : 
---------------
  Name + Controller 
  GeneresController 
  
Let create a method which returns the list of generous.

Lets say we returns the list of generous 
So its return type must be of list of type generous.

 [HttpGet("Get")]
        public async Task<ActionResult<List<Genre>>> Get()
        {
            var generes = await _context.generes.ToListAsync();
            return Ok(generes); 
        }
  [HttpGet("Get")] -> This the route 
          
  Let we want to get the generous by id 
  we can write a different method for this or we can use same get method.
   In this for parameter we will pass id 
     
   [HttpGet("Get")]
        public async Task<ActionResult<List<Genre>>> Get(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
          //If the genere is not found we can return NotFound method 
          to use this method we should extend the class for ControllerBase 
          
            if (genere == null)
            {
                return NotFound();
            }
            return Ok(genere);
        }
          
          But here we have two methods with same name 
          so .net will confuses which method to be called.
          So we have to use the routing roule.
          
