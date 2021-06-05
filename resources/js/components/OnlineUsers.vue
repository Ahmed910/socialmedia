<template>
  <ul class="list-group" id="online-users">

  </ul>
</template>

<script>
export default {
  name: "online-users",
  mounted() {
      let onlineUsersLength=0;
    Echo.join(`online`)
      .here((users) => {
          onlineUsersLength=users.length
          if(users.length > 1){
              $('#no-online-users').css('display','none');
          }
          let userId=$('meta[name=user-id]').attr('content');

        users.forEach(function(user){
            if(user.id==userId){
                return;
            }
            $('#online-users').append(`<li id="user-${user.id}" class="list-group-item"><i class="fa fa-circle text-success"></i> ${user.name}</li>`)
        })
      })
      .joining((user) => {
          onlineUsersLength++;
          $('#no-online-users').css('display','none');
         $('#online-users').append(`<li id="user-${user.id}" class="list-group-item"><i class="fa fa-circle text-success"></i> ${user.name}</li>`)
      })
      .leaving((user) => {
          onlineUsersLength--;
          if(onlineUsersLength==1){
               $('#no-online-users').css('display','block');
          }
        $('#user-'+user.id).remove();
      });
  },
  data() {
    return {};
  },
};
</script>

