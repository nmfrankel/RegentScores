
const logout = () => {
	fetch('./api/logout')
		.then(res => res.json())
		.then(json => {
			if(json.loggedOut) console.log('User was successfully logged out')
			else console.log('Err: '+json.msg)
		})
}