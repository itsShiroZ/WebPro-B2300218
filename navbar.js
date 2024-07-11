const toggleBtn = document.querySelector('.toggle_btn')
const toggleBtnIcon = document.querySelector('.toggle_btn i')
const dropdown = document.querySelector('.dropdown')

toggleBtn.onclick = function() {
    dropdown.classList.toggle('open')
    const isOpen = dropdown.classList.contains('open')

    toggleBtnIcon.classList = isOpen
        ? 'bx bx-x' 
        : 'bx bx-menu'
}