Getting basket with basket items.

we can get basket items by including the items 

 .Include( i => i.Items)

 public async Task<ActionResult<Basket>> GetAll()
        {
            var Basket = await _context.Baskets
                .Include( i => i.Items)
                .FirstOrDefaultAsync(x => x.BuyerId == "naveen");
            return Ok(Basket);

        }

but the basketItem have also basket so when an basket item is loaded we need to load the product also .


