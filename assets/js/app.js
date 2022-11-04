import '../css/app.scss';
import { Dropdown } from 'bootstrap';

document.addEventListener('DOMContentLoaded',() => { // JAVA* au moment ou le document est complétement chargé on apelle la fonction enableDropdowns activer les listes deroulantes();//
    enableDropdowns();

});

const enableDropdowns = () => {
    const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
 dropdownList = [...dropdownElementList].map(dropdownToggleEl => new Dropdown(dropdownToggleEl))
};
