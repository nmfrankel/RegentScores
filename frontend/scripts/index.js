const useLive = window.location.host === '127.0.0.1',
loadingContainer = document.getElementById('loadingContainer')

const login = (e) => {
	e?.preventDefault()
	loadingContainer.classList.add('active')

	// validate form
	// validate form

	// prepare fetch data
	const data = {
		email: document.forms[0].email.value,
		pswd: document.forms[0].pswd.value
	},
	options = {
		method: 'POST',
		body: JSON.stringify(data),
		headers: {
			'Content-Type': 'application/json'
		}
	}

	fetch('./'+(useLive? 'static': 'api')+'/login', options)
		.then(res => res.json())
		.then(json => {
			loadingContainer.classList.remove('active')

			if(json.loggedIn && json.redirect) window.location.href = json.redirect
			else console.log('Err: '+json.msg)
		})
		.catch(err => console.error(err))
}