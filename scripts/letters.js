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
	const canvas = document.querySelector('.alphakat_generator .letters')
	document.querySelectorAll('.boards label').forEach(board => {
		board.addEventListener('click', () => {
			if(canvas.classList.contains('navy')) {
				canvas.classList.remove('navy')
			}
			
			if(canvas.classList.contains('black')) {
				canvas.classList.remove('black')
			}
			if(canvas.classList.contains('white')) {
				canvas.classList.remove('white')
			}

			document.querySelector('.alphakat_generator .letters').classList.add(board.getAttribute('data-colour'))
		})
	})

	document.querySelectorAll('.colour label').forEach(opt => {
		opt.addEventListener('click', () => {
			if(opt.htmlFor == 'bw') {
				if(!canvas.classList.contains('bw')) {
					canvas.classList.add('bw')
				}
			}
			else {
				canvas.classList.remove('bw')
			}
		})
	})
}