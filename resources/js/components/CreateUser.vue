<template>
    <div>
        <h3 class="text-center">Create User</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addUser">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                user:{
                    name: '',
                    email: '',
                    password: ''
                }
                }
               },
        methods:{
            addUser(){
                this.axios.post('/api/create', this.user)
                .then(({data}) => {
                        if(data !== 'User not have permission!'){
                            this.showAlert(data)
                        }else{
                            this.showAlert(data)
                        }
                    })
                .then(response =>(this.$router.push({path: '/dashboard'})))
                .catch(err=> console.log(err))
            },
            showAlert(mes){
                alert(mes)
            }
        }
    } 
</script>