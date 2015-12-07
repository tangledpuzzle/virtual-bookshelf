/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-02
* Time: 01:33 PM
* To change this template use Tools | Templates.
*/
it('should ignore notes containing only whitespace', function() {
	var name = "jotain";
    expect(search_product_by_name(name)).toBe(name);
    
});

