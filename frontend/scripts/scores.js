const userInfo = document.getElementById('userInfo'),
scoresContainer = document.getElementById('scoresContainer')

const displayLoadError = () => {
	userInfo.innerText = `Undefined ('Error: 0xC3')`
	while (scoresContainer.children[1]) scoresContainer.children[1].remove()
	scoresContainer.classList.remove('loading')
}

const fetchScores = () => {
	scoresContainer.classList.add('loading')

	fetch('./api/scores')
		.then(res => {
			if(res.status >= 200 && res.status <= 299) return res.json()
			throw Error(res)
		})
		.then(json => {
			userInfo.innerText = `${json.first} ${json.last} (${json.student_id})`
			scoresContainer.classList.remove('loading')

			json.scores.forEach((scoreData, i) => {
				const entry = scoresContainer.children[i],
				gradeRating = scoreData.grade >= 90? 'pass': (scoreData.grade >= 65? 'warning': 'fail')
				entry.classList.remove('hidden')

				entry.querySelector('.title').innerText = scoreData.subject
				entry.querySelector('.date').innerText = scoreData.date
				entry.querySelector('.score').classList.add(gradeRating)
				entry.querySelector('.score').innerText = scoreData.grade
			})
		})
		.catch(err => {
			console.error(err)
			displayLoadError()
		})
}

// init data load
window.onload = setTimeout(fetchScores, 1250)