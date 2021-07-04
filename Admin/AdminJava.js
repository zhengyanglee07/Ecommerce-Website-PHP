function calFinalPrice(){
                var price = Number(document.getElementById('price').value);
                var rate = Number(document.getElementById('discount').value);
                var finalprice = price-((price*rate)/100);
                document.getElementById('PromoPrice').value = finalprice.toFixed(2);
            }
