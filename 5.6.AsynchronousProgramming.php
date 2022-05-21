An action can be syn or async 
Let supose we ordered a pizza to delivered to our home they delivered that in 30 
in that 30 min what will we do we will freze or we do some tasks in our house untill pizza arives.

So ansc is also like that 

When function 1 is running insted of waighting for function 1 responce our server will executes function2 
How ever we dont need all of our programs in anysc 

Using Anysc :
--------------
if we want to use anysc we should mention keyword anysc and return datatype is Task. 
so here async Task<datatype>
  
  meance in feature this method will return "datatype"
  async Task<List<Genere>>
  in feature this method will return list of genere 
  
        [HttpGet("GetAll")]
        [HttpGet("/allGeneres")]
        public async Task<ActionResult<List<Genre>>> GetAll()
        {
            var generes = await _context.generes.ToListAsync();
            return Ok(new { status = "success", data = generes, message = "Generes are found." });
        }
  
  delaying the tasks 
  -----------------
  we can delay the tasks by using await Task.Delay(1);
          
