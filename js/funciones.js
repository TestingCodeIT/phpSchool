var apiEndpoint = 'module/implementacionGafete/ajax/fuctions.php?FUNC=';
var Headers = {
    json: { header: 'Content-Type', value: 'application/json' },
    form: { header: 'Content-Type', value: 'application/x-www-form-urlencoded' }
};

var vm = new Vue({
    el: '#app',
	data:{
		datos:[],
        sub: [],
	},
	mounted:function(){
		this.consultar();

        //ssss
	},
    methods: {
		consultar: function(){
		    var self = this;
            //console.log("tito gay");
            var requestOptions = {
                method: 'POST',
                redirect: 'follow'
              };
              
              fetch("http://localhost:3031/LMS/crud.php?FUNC=1", requestOptions)
                .then(response => response.json())
                .then(result => {
                    
                    self.datos = result.data;
                    self.sub = result.otra;
                    console.log(self.sub);
                })
                .catch(error => console.log('error', error));
		},
    }
});