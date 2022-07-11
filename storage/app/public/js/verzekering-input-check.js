const ja_btn = document.querySelector('#verzekering_ja');
const nee_btn = document.querySelector('#verzekering_nee');

document.querySelector('#verzekeringInfo').style.display = 'none';

ja_btn.addEventListener('click', () => {
    yesnoCheck();
});

nee_btn.addEventListener('click', () => {
    yesnoCheck();
});

function yesnoCheck() {
    if (document.getElementById('verzekering_ja').checked) {
        document.querySelector('#verzekeringInfo').style.display = 'flex';
    }
    else document.querySelector('#verzekeringInfo').style.display = 'none';
}