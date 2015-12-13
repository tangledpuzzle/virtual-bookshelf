function putIntoSessionStorage(key, value)
{
	// Check for sessionStorage availability.
	if (typeof(sessionStorage) != 'undefined')
	{
		// Concatenate the key into an empty String in case something other than String was given.
		var keyString = ''.concat(key);
		
		// Stringify the value.
		// Set into sessionStorage.
		sessionStorage.setItem(keyString, value);
		
		if (sessionStorage.getItem(keyString) != null)
		{
			// Session storage was set.
			return true;
		}
		// Else: Session storage was not set, fall through and return false.
	}
	return false;
}