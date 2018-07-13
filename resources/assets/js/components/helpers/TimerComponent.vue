<template>
	<a class="pull-right" href="#">
       <span class="label label-purple">{{ hours | two_digits }} : {{ minutes | two_digits }} : {{ seconds | two_digits }}</span>
    </a>
</template>
<script>
export default {
    mounted() {
        window.setInterval(() => {
            this.now = Math.trunc((new Date()).getTime() / 1000);
        },1000);
    },
    props : {
        date : {
            type: Number,
            date: null,
        }
    },
    data() {
        return {
            now: Math.trunc((new Date()).getTime() / 1000),
            event: this.date,
        }
    },
    filters: {
		two_digits: function (value) {
			if(value.toString().length <= 1)
			{
				return "0"+value.toString();
			}
			return value.toString();
		}
	},
    computed: {
    	calculatedDate: function() {
            return this.event;
        },
        seconds: function() {
            return (this.now - this.calculatedDate) % 60;
        },
        minutes: function() {
            return Math.trunc((this.now - this.calculatedDate) / 60) % 60;
        },
        hours: function() {
            return Math.trunc((this.now - this.calculatedDate) / 60 / 60) % 24;
        },
        days: function() {
            return Math.trunc((this.now - this.calculatedDate) / 60 / 60 / 24);
        }
    }
}
</script>