sideMenu("requests", true,"clients");

let contactMask = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(contactMask.apply({}, arguments), options);
        }
    };

$("#contact").mask(contactMask, spOptions);
$("#cellphone").mask(contactMask, spOptions);
$("#others").mask(contactMask, spOptions);
$("#seller-contact").mask(contactMask, spOptions);
$("#seller-cell").mask(contactMask, spOptions);
$("#seller-others").mask(contactMask, spOptions);

let documentMask = function (val) {
        return val.replace(/\D/g, '').length < 12 ? '000.000.000-000' : '00.000.000/0000-00';
    },
    documentOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(documentMask.apply({}, arguments), options);
        }
    };

$("#document").mask(documentMask, documentOptions);

let options =  {
    onComplete: function(cep) {
        search_cep(cep);
        $("#number").focus();
    }
};

$("#cep").mask('00000-000',options);

function search_cep(value){
    let cep = value.replace(/\D/g, '');

    if (cep !== "") {
        //Expressão regular para validar o CEP.
        let validacep = /^[0-9]{8}$/;
        //Valida o formato do CEP.
        if(validacep.test(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            cep_fields("...","...","...","...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    cep_fields(dados.logradouro,dados.bairro,dados.localidade,dados.uf);
                } else {
                    //CEP pesquisado não foi encontrado.
                    cep_fields();
                    alert("CEP não encontrado.");
                }
            });
        }else {
            //cep é inválido.
            cep_fields();
            alert("Formato de CEP inválido.");
        }
    }else {
        //cep sem valor, limpa formulário.
        cep_fields();
    }
}

function cep_fields(adress = "", district = "", city = "", state = ""){
    $("#address").val(adress);
    $("#district").val(district);
    $("#city").val(city);
    $("#state").val(state);
}

$("#new-client-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Concluído");
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Salvo com sucesso!");
            if ( !$( "#client_id" ).length ) {
                returnMessage("Redirecionando...");
                setTimeout(function () {
                    window.location = callback.client_path;
                }, 1500);
            }
        }
    });
});

$("#edit-client-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#button-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Atualizar").prop('disabled',false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Atualizado com sucesso!");

        }
    });
});


$("#new-seller-form").submit(function (e) {
    e.preventDefault();
    let bnt = $("#seller-submit");
    bnt.prop('disabled', true);
    bnt.html("<span class=\"spinner-border\" role=\"status\" aria-hidden=\"true\"></span>");
    let forms = $(this);

    sendAjax(forms.attr("action"), forms.serialize(), function (callback) {
        bnt.html("Salvar").prop('disabled',false);
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            returnMessage("Salvo com sucesso!");
            reset_seller()
            $('#table-seller').DataTable().ajax.reload();
            $("#seller-modal").modal("hide");
        }
    });
});

function reset_seller(){
    $("#seller_id").val("");
    $("#seller-name").val("");
    $("#seller_role").val("");
    $("#seller-contact").val("");
    $("#seller-cell").val("");
    $("#seller-others").val("");
    $("#seller-email").val("");
}

function changeStatus(seller_id, status){
    sendAjax("/status-comercial", {seller_id : seller_id, status: status}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $('#table-seller').DataTable().ajax.reload();
            if (callback.status === "1"){
                returnMessage("Ativado com sucesso!");
            }else{
                returnMessage("Desativado com sucesso!");
            }

        }
    });
}

function editSeller(seller_id){
    sendAjax("/editar-comercial", {seller_id : seller_id}, function (callback) {
        if (callback.erro) {
            returnMessage(callback.erro, "FF0000", "8B0000");
        } else if (callback.success === 200) {
            $("#seller_id").val(callback.seller_id);
            $("#seller-name").val(callback.seller_name);
            $("#seller_role").val(callback.seller_role);
            $("#seller-email").val(callback.seller_mail);
            $("#seller-cell").val(callback.seller_cell);
            $("#seller-contact").val(callback.seller_contact);
            $("#seller-others").val(callback.seller_others);
            $("#seller-modal").modal("show");
        }
    });
}

$("#table-seller").DataTable({
    ajax: {
        url: URL + '/tabelas/vendedores',
        type: 'POST',
        data: {client_id: $("#client_id").val()}
    },
    language: {
        url: URL + '/views/assets/vendors/DataTables/pt_br.json'
    }
});