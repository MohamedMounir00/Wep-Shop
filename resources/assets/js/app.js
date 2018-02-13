var  Vue = require('vue/dist/vue.js');


var VueRouter=require('vue-router/dist/vue-router.js');
Vue.use(VueRouter);
var VueResource = require('vue-resource/dist/vue-resource.js');

Vue.use(VueResource);
var VueValidator=require('vue-validator/dist/vue-validator.js');
Vue.use(VueValidator);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementById('_token').getAttribute('value');


var App=Vue.extend({});

var route                    = new VueRouter();
var MainPages                = require('./com/pages/MainPages.vue');
var AddServices              = require('./com/services/addservices.vue');
var Myservices               = require('./com/services/Myservices.vue');
var IncomedOrder             = require('./com/orders/IncomedOrder.vue');
var SendOrder                = require('./com/orders/SendOrder.vue');
var ServicesDetails          = require('./com/services/sarvices_detalis.vue');
var UserServices             = require('./com/users/userservices.vue');
var SingleOrder              = require('./com/orders/SingleOrder.vue');
var SendMessage              = require('./com/message/Send.vue');
var GetMySendMessageNow      = require('./com/message/SendMessage.vue');
var GetMyReseviedMessage     = require('./com/message/IncomeMessage.vue');
var GetThisMessageDetiles    = require('./com/message/MessageDetalis.vue');
var GetMyNewMessage          = require('./com/message/NewNessage.vue');
var GetMyReadMessage         = require('./com/message/ReadMessage.vue');
var GetMyFaveroits           = require('./com/fav/MyFaveroits.vue');
var Cat                      = require('./com/cat/cat.vue');
var AddCredit                = require('./com/cart/AddCredit.vue');
var ShowAllCharge            = require('./com/cart/ShowAllCharge.vue');
var ShowAllPay               = require('./com/cart/ShowAllPay.vue');
var profit                   = require('./com/cart/profit.vue');
var Blance                   = require('./com/cart/Blance.vue');
var Notfication              = require('./com/Notfication/all.vue');
var Loginrequired            = require('./com/error/login.vue');
var RetainedProfits            = require('./com/cart/RetainedProfits.vue');








route.map({

 '/':{
        component:MainPages

    },
    '/AddServices':{
        component:AddServices

    },
    '/Myservices':{
        component:Myservices

    },
    '/IncomedOrder':{
        component:IncomedOrder

    },
    '/SendOrder':{
        component:SendOrder

    },
  
    '/sarvices_detalis/:services_id/:services_name':{
        name:'ServicesDetails',
        component:ServicesDetails

    },
      '/UserServices/:user_id/:username':{
        name:'/UserServices',
        component:UserServices

    },
      '/Order/:order_id':{
        name:'/Order',
        component:SingleOrder

    },
    
      '/SendMessage/:user_id':{
        name:'/SendMessage',
        component:SendMessage

    },
        '/GetMySendMessage':{
    
        component:GetMySendMessageNow

    },
       '/GetMyReseviedMessage':{
    
        component:GetMyReseviedMessage

    },
       '/GetMyNewMessage':{
    
        component:GetMyNewMessage

    },
      '/GetMyReadMessage':{
    
        component:GetMyReadMessage

    },
    '/GetThisMessageDetiles/:message_id/:viewtype':{
        name:'/GetThisMessageDetiles',
        component:GetThisMessageDetiles

    },

    '/GetMyFaveroits':{
    
        component:GetMyFaveroits

    },
  
  '/Cat/:cat_id/:cat_name':{
        name:'/Cat',
        component:Cat

    },


   
    '/AddCredit':{
    
        component:AddCredit

    },
    
    '/ShowAllCharge':{
    
        component:ShowAllCharge

    },
  '/ShowAllPay':{
    
        component:ShowAllPay

    },

    '/profit':{
    
        component:profit

    },
      '/RetainedProfits':{
    
        component:RetainedProfits

    },

  '/Blance':{
    
        component:Blance

    },
  '/Notfication':{
    
        component:Notfication

    },
 '/Loginrequire':{
    
        component:Loginrequired

    },


});
route.start(App , '#app-layout');