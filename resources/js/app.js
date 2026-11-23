import './bootstrap';
import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.css';
import duallistbox from 'bootstrap4-duallistbox';
import 'bootstrap4-duallistbox/dist/bootstrap-duallistbox.css';
import Alpine from 'alpinejs';

window.$ = window.jQuery = $;
select2(window, $);
duallistbox(window, $);

$(function () {
    $('#filters').select2({
        width: '100%',
        placeholder: 'Оберіть мітки',
    });

    $('#duallist').bootstrapDualListbox({
        nonSelectedListLabel: 'Доступні мітки',
        selectedListLabel: 'Обрані мітки',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: false,
        infoText: 'Усього {0}',
        filterPlaceHolder: 'Пошук',
    });
});

window.Alpine = Alpine;
Alpine.start();
