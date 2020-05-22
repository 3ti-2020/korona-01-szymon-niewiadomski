import {Product} from './product.js';

const cart = {
    products: new Array(),
    table: document.querySelector('.cart--table'),
    emptyBtn: document.querySelector('.cart--empty-button'),
    payBtn: document.querySelector('.payment--submit'),
    init(){
        this.emptyBtn.addEventListener('click', this.emptyCart.bind(this));
        this.emptyNode = document.querySelector('.cart--empty').cloneNode(true);
        this.getCart().then(res=>{
            if(res.length){
                this.createProducts(res);
            }
            this.updateList();
        })
    },
    getCart(){
        return fetch('php/getCart.php').then(res=> res.json());
    },
    createProducts(res){
        res.forEach((product, i) => {
            this.products[i] = new Product(product);
        });
        this.bind();
        this.appendRows();
    },
    appendRows(){
        this.table.innerHTML = '';
        this.products.forEach(product=>{
            this.table.append(product.row.element);
        })
    },
    bind(){
        this.products.forEach(product=>{
            product.row.cross.addEventListener('click', ()=>{
                this.removeProduct(product.id);
            });
            product.row.counter.addEventListener('blur', ()=>{
                this.updateCounter(product.id);
            });
        })
    },
    removeProduct(id){
        const data = new FormData();
        data.append('product_id', id);
        
        fetch('php/removeFromCart.php', {
            method: 'post',
            body: data,
        }).then(res=> {
            const row = this.products.find(p=> p.id == id).row.element;
            
            row.classList.add('remove');
            setTimeout(()=>{
                row.remove();
            }, 400);

            this.products = this.products.filter(p=> p.id != id);
            this.updateList();
            if(this.isEmpty())setTimeout(()=> this.appendEmptyRow(),400);
        });
    },
    isEmpty(){
        if(this.products.length) return false;
        else return true;
    },
    appendEmptyRow(){
        this.table.innerHTML='';
        this.emptyNode.classList.add('appear')
        this.table.append(this.emptyNode);
        setTimeout(()=> this.emptyNode.classList.remove('appear'), 100);
    },
    updateCounter(id){
        const product = this.products.find(p=> p.id == id);
        const counter = product.row.counter;
        const value = counter.value;

        if(this.validateCounter(value) && value != product.count){
            const data = new FormData();
            data.append('count', value);
            data.append('product_id', product.id);

            fetch('php/updateCount.php', {
                method: 'post',
                body: data
            }).then(res=> {
                product.count = value;
                this.updateList();
            })
        } else counter.value = product.count;
    },
    validateCounter(val){
        if(val > 0 && val < 100) return true;
        else return false;
    },
    makeBill(){
        const deliveryDiv = document.querySelector('.summary--delivery');
        const productsDiv = document.querySelector('.summary--products');
        const billDiv = document.querySelector('.summary--sum');

        let deliveryCost = this.calcDelivery();
        let productsCost = 0;
        this.products.forEach(product=>{
            productsCost += parseFloat(product.price) * parseFloat(product.count);
        })
        this.bill = deliveryCost + productsCost;
        deliveryDiv.innerHTML = "<span>Dostawa: </span><span>+" + deliveryCost + ' zł</span>';
        productsDiv.innerHTML = "<span>Zakupy: </span><span>" + productsCost + ' zł</span>';
        billDiv.innerHTML = "<span>Do zapłaty: </span><span>"+ (deliveryCost + productsCost) + ' zł</span>';
    },
    calcDelivery(){
        let len = this.countProducts();
        if(len == 0) return 0;
        else if(len > 0 && len <=5) return 5;
        else if(len > 5 && len <=10) return 10;
        else if(len > 10 && len <=15) return 15;
        else if(len > 15) return 20;
    },
    countProducts(){
        let count = 0;
        this.products.map(p=> count +=parseInt(p.count));
        return count;
    },
    emptyCart(){
        console.log('test');
        const data = new FormData();
        data.append('flag', 'true');

        fetch('php/emptyCart.php', {
            method: 'post',
            body:  data,
        }).then(res=>{
            this.products = new Array();
            this.appendEmptyRow();
            this.updateList();
        })
    },
    updateCartCount(){
        const counter = document.querySelector('.cart--count');
        counter.innerHTML = this.countProducts();
        if(this.countProducts() > 0) {
            this.emptyBtn.style.display="block";
        }
        else {
            this.emptyBtn.style.display="none";
        }
    },
    updateList(){
        this.updateCartCount();
        this.makeBill();
        this.updateForm();
    },
    updateForm(){
        if(this.countProducts() > 0) {
            this.payBtn.disabled = false;
        }
        else {
            this.payBtn.disabled = true;
        }
        
        const products = [];
        this.products.map(p=>{
            products.push(p.id +'/'+p.count);
        });

        document.querySelector('input[name="cost"]').value = this.bill;
        document.querySelector('input[name="products"]').value = products.join(',');
    }
}

cart.init();