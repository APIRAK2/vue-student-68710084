<template>
  <div class="container mt-5">
         <div class="row justify-content-center">
             <div class="col-md-6">
                 <div class="card shadow-lg p-4">
                     <h2 class="text-center mb-4">เพิ่มข้อมูลนักศึกษา</h2>
 
         <form @submit.prevent="addCustomer">
 
           <div class="mb-3">
             <label class="form-label">ชื่อ</label>
             <input type="text" class="form-control"
               v-model="form.first_name" placeholder="ชื่อ" required>
           </div>
 
           <div class="mb-3">
             <label class="form-label">นามสกุล</label>
             <input type="text" class="form-control"
               v-model="form.last_name" placeholder="นามสกุล" required>
           </div>
 
           <div class="mb-3">
             <label class="form-label">เบอร์โทรศัพท์</label>
             <input type="text" class="form-control"
               v-model="form.phone" placeholder="เบอร์โทรศัพท์" required>
           </div>
 
           <div class="mb-3">
             <label class="form-label">email</label>
             <input type="email" class="form-control"
               v-model="form.email" placeholder="email" required>
           </div>
 
           <div class="mb-3">
              <select class="form-select" v-model="form.faculty" required>
                <option value="" disabled>คณะ</option>
                <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                <option value="ครุศาสตร์">ครุศาสตร์</option>
              </select>
            </div>
 
           <button type="submit" class="btn btn-primary w-100">
             บันทึก
           </button>
 
         </form>
 
         <!-- แสดงผล -->
         <div v-if="message" class="alert mt-3"
              :class="status === 'success' ? 'alert-success' : 'alert-danger'">
           {{ message }}
         </div>
 
       </div>
     </div>
   </div>
  </div>
 </template>
 
 <script>
 export default {
   data() {
     return {
       form: {
         first_name: '',
         last_name: '',
         phone: '',
         email: '',
         faculty: ''
       },
       message: '',
       status: ''
     }
   },
   methods: {
     async addCustomer() {
       try {
         const res = await fetch('http://localhost/vue-student-68710084/php_api/add_student.php', {
           method: 'POST',
           headers: {
             'Content-Type': 'application/json'
           },
           body: JSON.stringify(this.form)
         });
 
         const result = await res.json();
 
         this.message = result.message;
         this.status = result.status;
 
         // เคลียร์ฟอร์ม
         if (result.status === 'success') {
           this.form = {
             first_name: '',
             last_name: '',
             phone: '',
             email: '',
             faculty: ''
           };
         }
 
       } catch (error) {
         this.message = 'เชื่อมต่อ API ไม่สำเร็จ';
         this.status = 'error';
       }
     }
   }
 }
 </script>