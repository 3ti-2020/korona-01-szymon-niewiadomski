class Product{
    constructor(id, name, description, category, price, img){
        this.id = id;
        this.name = name;
        this.description = description;
        this.category = category;
        this.price = price;
        this.img = img;
    }
    createItem(){
        const anchor = document.createElement('a');
        anchor.setAttribute('href', 'product.php?product=' + this.id);
        anchor.classList.add('product--link');

        const li = document.createElement('li');
        li.classList.add('product');

        const img = new Image();
        img.src= `img/products/${this.img}.jpg`;
        img.classList.add('product--img');
        li.append(img);

        const div = document.createElement('div');
        div.classList.add('product--text');
        li.append(div);

        const name = document.createElement('p');
        name.classList.add('product--name');
        name.innerHTML = this.name;
        div.append(name);

        const price = document.createElement('p');
        price.classList.add('product--price');
        price.innerHTML = this.price + ' zł';
        div.append(price);

        anchor.append(li);
        return anchor;
    }
}

const productsList = {
    products: null,
    list: document.querySelector('.products--list'),
    init(){
        this.getProducts().then(res=>{
            this.products = res;
            console.log(res);
            this.createList();
        });
    },
    getProducts(){
        return fetch('php/getProducts.php').then(res=>res.json());
    },
    createList(){
        this.products.forEach(product => {
            const item = new Product(product['product_id'], product['name'], product['description'], product['category'], product['price'], product['img']);
            this.list.append(item.createItem());

        });
    },
    checkUrl(){
        const url = window.location.href;
    }
}
productsList.init();
