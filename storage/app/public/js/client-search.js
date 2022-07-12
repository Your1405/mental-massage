$(document).ready(function(){

    fetch_client_data();
   
    function fetch_client_data(query = '')
    {
     $.ajax({
      url:"/client-search",
      method:'GET',
      data:{query:query},
      dataType:'json',
      success:function(data){
        $('#user-selection').empty();

        data.map((client_data) => {
            let client_id = client_data.clientId;
            let client_voornaam =  client_data.clientVoornaam;
            let client_achternaam =  client_data.clientNaam;
            let client_email =  client_data.clientEmail;

            let client_select = `<option value="${client_id}">${client_achternaam} ${client_voornaam} | ${client_email}</option>`
            $('#user-selection').append(client_select);
        });
        }
    })
    }
   
    $(document).on('keyup', '#client-search', function(){
     var query = $(this).val();
     fetch_client_data(query);
    });
   });