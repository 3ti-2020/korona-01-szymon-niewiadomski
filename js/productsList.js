import {Product} from './product.js';

const productsList = {
    products: new Array(),
    list: document.querySelector('.products--list'),
    filterHeader: document.querySelector('.filter--header'),
    sortingSelect: document.querySelector('.filter--select'),
    init(){
        this.setFilterHeader();
        this.getProducts().then(res=>{
            this.sortingSelect.addEventListener('change', this.sortProducts.bind(this));
            this.createProducts(res);
        });
    },
    getProducts(){
        return fetch('php/getProducts.php?category='+this.getParam()).then(res=>res.json());
    },
    createProducts(productsArray){
        productsArray.forEach((product, i) => {
            this.products[i] = new Product(product);
        });
        this.appendList();

    },
    appendList(){
        this.list.innerHTML = '';
        this.products.forEach(product =>{
            this.list.append(product.item);
        });
    },
    getParam(){
        const categories = ['weights', 'clothes', 'machines', 'accessories'];
        const url = window.location.search;
        const params = new URLSearchParams(url);
        const category = params.get('category');

        if(category == null) return 'all';
        if(categories.indexOf(category) == -1) window.location.href = "index.php";
        else return category;
    },
    setFilterHeader(){
        let header = "Sklep \\ ";
        switch(this.getParam()){
            case 'weights':
                header += "Wolne ciężary";
                break;
            case 'clothes':
                header += "Odzież";
                break;
            case 'machines':
                header += "Maszyny";
                break;
            case 'accessories':
                header += "Akcesoria";
                break;
            default:
                header += "Cały asortyment";
                break;    
        }
        this.filterHeader.innerHTML = header;
    },
    sortProducts(e){
        const sortType = e.target.value;
       console.log(sortType);
        switch(sortType){
            case 'price_asc':
                this.products = this.products.sort(this.sortByPrice);
                break;
            case 'price_desc':
                this.products = this.products.sort(this.sortByPrice);
                this.products = this.products.reverse();
                break;
            case 'alpha_asc':
                this.products = this.products.sort(this.sortByName);
                break;
            case 'alpha_desc':
                this.products = this.products.sort(this.sortByName);
                this.products = this.products.reverse();

                break;
            case 'none':
                this.products = this.products.sort(this.sortById);
                break;    
        }

        this.appendList();
    },
    sortByPrice(a, b){
        return a.price - b.price;
    },
    sortByName(a, b){
        return a.name.localeCompare(b.name);
    },
    sortById(a, b){
        return a.id - b.id;
    }
}
productsList.init();
