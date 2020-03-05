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