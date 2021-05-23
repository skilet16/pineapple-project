new Vue({
  el: '#app',
  data: {
    email: '',
    checkbox: false,
    disable: true,
    reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
  },
  computed: {
    isDisabled: function() {
      return this.disable;
    }
  },
  methods: {
    isEmailValid: function() {
      if(this.email == "") {
        this.disable = true;
        return "Email address is required";
      } else if (!this.reg.test(this.email)) {
        this.disable = true;
        return "Please provide a valid e-mail address";
      } else if (this.email.slice(-3) == ".co") {
        this.disable = true;
        return "We are not accepting subscriptions from Colombia emails";
      } else if (!this.checkbox) {
        this.disable = true;
        return "You must accept the terms and conditions";
      }
      this.disable = false;
    }
  }
});
