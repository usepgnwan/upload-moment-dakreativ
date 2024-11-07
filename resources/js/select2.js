import select2 from 'select2';
select2();
import 'select2/dist/css/select2.min.css';
import { select,on } from './custom';
const initSelect2 = () =>{
    // console.log($)
    if (select('.select2-init') != null) {
        select('.select2-init', true).forEach((el) => {
            if (el.getAttribute('data-select2-id') != null) {
                el.nextElementSibling.remove();
            }
            // if(el.getAttribute('data-selected') != null){
            //     console.log(el.getAttribute('data-selected'))
            // }
            let e = $(el).select2({
                containerCssClass: "error",
            });
        })
    }
}

export default initSelect2
