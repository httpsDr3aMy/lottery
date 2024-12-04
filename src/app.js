const checkboxes = document.querySelectorAll('input[type="checkbox"][name="numbers[]"]');
const maxChecked = 6;
const modal = document.getElementById('maxNumbersModal');
const closeModalButton = document.getElementById('closeModalButton');

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        const checkedCount = document.querySelectorAll('input[type="checkbox"][name="numbers[]"]:checked').length;

        if (checkedCount > maxChecked) {
            checkbox.checked = false; 
            modal.classList.remove('hidden'); 
        }
    });
});


closeModalButton.addEventListener('click', function () {
    modal.classList.add('hidden'); 
});
