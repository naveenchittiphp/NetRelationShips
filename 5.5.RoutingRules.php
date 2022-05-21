Routing Rules are a mechanism that allows us to map a url with an action.

When we make an http request to an action an ent point to be executed.

 [HttpGet("Get")]
        public async Task<ActionResult<List<Genre>>> Get()
        {
            var generes = await _context.generes.ToListAsync();
            return Ok(generes); 
        }
       
        public async Task<ActionResult<Genre>> Get(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return NotFound();
            }
            return Ok(genere);
        }
        
        Here we have to methods with same calss.So we have to change the route name.
        
        [HttpGet("example")]
        public async Task<ActionResult<Genre>> Get(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return NotFound();
            }
            return Ok(genere);
        }
        
        Now route will be : api/generes/example?id=1 
        
        we can also change this by 
        
          [HttpGet("example")]
        public async Task<ActionResult<Genre>> Get(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return NotFound();
            }
            return Ok(genere);
        }
        
        Second Method:
        --------------
        https://localhost:7100/api/Generes/GetById/1
        
        
        [HttpGet("GetById/{id}")]
        public async Task<ActionResult<Genre>> GetById(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return NotFound();
            }
            return Ok(genere);
        }
        
        so here we are passing the id in parameter 
        this id in route and parameter must match with each other.
        So here we always pass the OutPut return type which is our custom return type.
        [HttpGet("GetById/{id}")]
        public async Task<ActionResult<OutPut>> GetById(int id)
        {
            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return Ok(new{status="fail",message="No gener founds"});
            }
            return Ok(new { status = "success", data= genere, message = "Generes are found." });
        }
        
        We can use two types are routes for same method for example 
        we want to get list of genere for this now we are using GetAll route by we can also make that by allGeneres
        
        https://localhost:7100/api/Generes/GetAll
        https://localhost:7100/allGeneres
        [HttpGet("GetAll")]
        [HttpGet("/allGeneres")]
        public async Task<ActionResult<List<Genre>>> GetAll()
        {
            var generes = await _context.generes.ToListAsync();
            return Ok(generes); 
        }
        
        Duel Parameters:
        -------------
        we can also pass the duel parameters with default values.
         [HttpGet("GetById/{id:int}/{name=''}")]
        public async Task<ActionResult<OutPut>> GetById(int id)
        {

            var genere = await _context.generes.Where(x => x.Id == id).FirstOrDefaultAsync();
            if (genere == null)
            {
                return Ok(new{status="fail",message="No gener founds"});
            }
            return Ok(new { status = "success", data= genere, message = "Generes are found." });
        }
        
        
        {id:int -> here we have to define the datatype in parameters also other wise the action is executed even we send string and we get 204 response.
        if we made it as int then we will recive 404 error.
