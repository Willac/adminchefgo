curl --request POST \
  --url https://api.conekta.io/orders \
  --header 'accept: application/vnd.conekta-v2.0.0+json' \
  -u key_fpyk2GxsVnFMYFVqgx1KGQ: \
  --header 'content-type: application/json' \
  --data '{
    "line_items": [{
        "name": "Tacos",
        "unit_price": 1000,
        "quantity": 12
    }],
    "shipping_lines": [{
        "amount": 1500,
        "carrier": "FEDEX"
    }],
    "currency": "MXN",
    "customer_info": {
        "name": "Fulanito Pérez",
        "email": "kdex999@gmail.com",
        "phone": "+5218181818181"
      },
      "shipping_contact":{
           "address": {
               "street1": "Calle 123, int 2",
               "postal_code": "06100",
               "country": "MX"
           }
       },
      "charges":[{
          "payment_method": {
              "type": "oxxo_cash"
          }
      }]
  }'
