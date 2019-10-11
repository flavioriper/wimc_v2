

function cpf(v){
 
	//Remove tudo o que nÃ£o Ã© dÃ­gito
	v=v.replace(/\D/g,"");

	//Coloca um ponto entre o terceiro e o quarto dÃ­gitos
	v=v.replace(/(\d{3})(\d)/,"$1.$2");

	//Coloca um ponto entre o terceiro e o quarto dÃ­gitos
	//de novo (para o segundo bloco de nÃºmeros)
	v=v.replace(/(\d{3})(\d)/,"$1.$2");

	//Coloca um hÃ­fen entre o terceiro e o quarto dÃ­gitos
	v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
 
	return v;
 
}

function cep(v){
 
	//Remove tudo o que nÃ£o Ã© dÃ­gito
	v=v.replace(/\D/g,"");

	//Coloca um ponto entre o segundo e o terceiro dÃ­gitos
	v=v.replace(/(\d{2})(\d)/,"$1.$2");

	//Coloca um traÃ§o entre o terceiro e o quarto dÃ­gitos
	//de novo (para o segundo bloco de nÃºmeros)
	v=v.replace(/(\d{3})(\d)/,"$1-$2");
 
	return v;
}

function phone(v){
 
	//Remove tudo o que nÃ£o Ã© dÃ­gito
	v=v.replace(/\D/g,"");

	//Coloca os parÃªnteses
	v=v.replace(/(\d{2})(\d)/,"($1) $2");
	
	//coloca o traÃ§o
	v=v.replace(/(\d{4})(\d)/,"$1-$2");
	return v;
}

function cellphone(v){
 
	//Remove tudo o que nÃ£o Ã© dÃ­gito
	v=v.replace(/\D/g,"");
	//coloca uma mÃ¡scara diferente para nÃºmeros com 10 ou 11 dÃ­gitos
	if (v.length === 11 ) { // (99) 0 9999-9999
		v=v.replace(/(\d{2})(\d{1})(\d)/,"($1) $2 $3");
	} else { // (18) 8888-8888
		v=v.replace(/(\d{2})(\d)/,"($1) $2");
	}
			
	v=v.replace(/(\d{4})(\d)/,"$1-$2");
	
	return v;
}

function email(v){
	
	return v;
}

function cnpj(v){

	//Remove tudo o que nÃ£o Ã© dÃ­gito
	v=v.replace(/\D/g,"");

	//CNPJ

	//Coloca ponto entre o segundo e o terceiro dÃ­gitos
	v=v.replace(/^(\d{2})(\d)/,"$1.$2");

	//Coloca ponto entre o quinto e o sexto dÃ­gitos
	v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");

	//Coloca uma barra entre o oitavo e o nono dÃ­gitos
	v=v.replace(/\.(\d{3})(\d)/,".$1/$2");

	//Coloca um hÃ­fen depois do bloco de quatro dÃ­gitos
	v=v.replace(/(\d{4})(\d)/,"$1-$2");

	return v;
 
}

function execmascara(v_obj, v_fun){

    v_obj.value = window[v_fun](v_obj.value);
}

function mascaraMutuario(o,f){
	let v_obj=o;
	let v_fun=f;
        
	setTimeout(execmascara(v_obj, v_fun),1);
}


