const changeImage = (letter) => {
	document.querySelector(`.alphakat_generator .letters .lightbox[data-index="${letter}"]`).classList.add('open')
}

const chooseImage = (id, url, letter) => {
	const art = document.querySelector(`.alphakat_generator .letters`)

	art.querySelector(`input[type="hidden"][data-index="${letter}"]`).value = id
	art.querySelector(`button[data-index="${letter}"] img`).src = url

	art.querySelector(`.lightbox[data-index="${letter}"]`).classList.remove('open')
}

const closeLightbox = (letter) => {
	document.querySelector(`.alphakat_generator .letters .lightbox[data-index="${letter}"]`).classList.remove('open')
}

window.onload = () => {
	document.querySelectorAll('.boards label').forEach(board => {
		board.addEventListener('click', () => {
			document.querySelector('.alphakat_generator .letters').classList.remove('navy').remove('black').remove('white')

			document.querySelector('.alphakat_generator .letters').classList.add(board.getAttribute('data-colour'))
		})
	})

	document.querySelector('.colour label').addEventListener('click', (e) => {
		if(!document.querySelector('.colour input').checked) {
			document.querySelector('.alphakat_generator .letters').classList.add('bw')
		}
		else {
			document.querySelector('.alphakat_generator .letters').classList.remove('bw')
		}
	})
}