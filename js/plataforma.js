var apiEndpoint = 'module/implementacionGafete/ajax/fuctions.php?FUNC=';
var Headers = {
    json: { header: 'Content-Type', value: 'application/json' },
    form: { header: 'Content-Type', value: 'application/x-www-form-urlencoded' }
};

var vm = new Vue({
    el: '#offcanvas',
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
              
              fetch("http://localhost:3031/LMS/crud.php?FUNC=cursos", requestOptions)
                .then(response => response.json())
                .then(result => {
                    if(result.data){
                        self.sub = result.data;
                        console.log(self.sub);
                    }else if(result.error){
                        throw result.error;
                    }else{
                        throw result;
                    }
                    
                })
                .catch(error => {
                    self.showSweet(
                        {
                            icon: 'error',
                            title: 'Oops...',
                            text: error,
                          }
                    );
                });
		},
        showSweet: function(params){
		    var self = this;
            //console.log("tito gay");
            Swal.fire(params);
		},

        
    }
});