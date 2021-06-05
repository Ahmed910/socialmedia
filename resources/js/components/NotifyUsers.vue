<template>
<li class="nav-item d-md-down-none">
<a class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-pill badge-info">{{unreadNotifications.length}}</span></a>
</li>
</template>
<script>
    export default {
	props: ["userid", "unreadnotifcation"],
  data(){

    return{
       unreadNotifications: this.unreadnotifcation,
    }
  },
   mounted() {
    this.listenForNotifications();
  },

  methods: {
    listenForNotifications() {
      Echo.private(`App.User.${this.userid}`).notification(
        (notification) => {

          let newNotification = notification.message;
          let sound = document.getElementById('play');

          this.unreadNotifications.unshift(newNotification);

          this.$toaster.success(newNotification);
           sound.play();

        }
      );
    }
    }
}
</script>
