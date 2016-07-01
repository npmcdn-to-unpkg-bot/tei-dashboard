  $(document).ready(function() {
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }


    fetchAttachments();

    //Function to fetch Attachments 
    function fetchAttachments(expertID){
      console.log('fetching Expert Attachment for expertID: '+ getUrlVars()["Id"]);
      var expAttch = new SObjectModel.expAttachment();
        expAttch.retrieve({
          where: {
            Expert__c: {eq: getUrlVars()["Id"] }
          },
          limit: 100
        }, function (err, records){
          if(err){
            console.log(err.message);
          }
          else {              
            records.forEach(function(record){
                var expAttachmentObj = {
                  Name: record.get('Name'),
                  Id: record.get('Id'),
                  Type__c: record.get('Type__c'),
                  Expert__c: record.get('Expert__c'),
                  Share__c: record.get('Share__c'),
                  Attachment__c: record.get('Attachment__c'),
                  Description__c: record.get('Description__c')
                };
                var checkbox;
                if(expAttachmentObj.Share__c == true){
                   checkbox = "checked";
                   console.log(checkbox);
                }
                var tableRow = $('<tr>'+
                  '<td><a target="_self" href="https://logintei.staging.wpengine.com/wp-content/themes/tei-dashboard/download_attachment.php?ID='+expAttachmentObj.Attachment__c+'&name='+expAttachmentObj.Name+'">'+expAttachmentObj.Name+'</a></td>'+//attchment name 
                  '<td>'+expAttachmentObj.Type__c+'</td>'+ // type                            
                  '<td><input type="checkbox" '+checkbox+'></td>'+
                '</tr>');
                $('.attachmentTable').append(tableRow);
            });
          }
        });
    }

    styleFileInput();
    // Style file input 
    function styleFileInput(){  
      // var inputSvg = $('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>');
      // inputSvg.prependTo('.fileContainer');

      $("input[type='file']").dropify();


    }
  });