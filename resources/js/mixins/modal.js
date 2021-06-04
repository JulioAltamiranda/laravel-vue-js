const myMixin = {
	mounted: () => {
		let openModal = null
		const btnClose = null
		const modalContainer = document.querySelectorAll('.modal-container')
		let modal = null;
		document.addEventListener('click', (e) => {
			//open modal
			if (openModal = e.target.closest('.btn-open-modal')) {
				e.preventDefault()
				if (modal = document.querySelector(`#${openModal.dataset.name}`)) {
					modal.classList.add('active')
				}
			}
			//close modal
			if (e.target.closest('.btn-close-modal')) {
				e.preventDefault()
				modalContainer.forEach((element) => {
					element.classList.remove('active')
				})
			}
		})
	},
	methods: {
		closeModal: function () {
			const modalContainer = document.querySelectorAll('.modal-container')
			modalContainer.forEach((element) => {
				element.classList.remove('active')
			})
		}
	}


}
export default myMixin