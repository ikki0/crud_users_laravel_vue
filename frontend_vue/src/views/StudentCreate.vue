<template>
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center ">
                    <h1>Crear Estudiantes</h1>
                </div>
                <div class="card-body">
                    <form @submit.prevent="processCreateStudent($event)">
                        <div class="d-grid col-6 mx-auto mb-3">
                            <img v-if="createStudent.foto" :src="createStudent.foto" alt="imagen foto estudiante"
                                id="photo" class="img-thumbnail custom_image custom_img_true">
                            <img v-else src="https://cdn-icons-png.freepik.com/512/7175/7175414.png" id="photo"
                                alt="imagen foto estudiante" class="img-thumbnail custom_image custom_img_false">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input v-model="createStudent.nombre" type="text" placeholder="Nombre Estudiante..."
                                required maxlength="50" id="name" class="form-control">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input v-model="createStudent.apellido" type="text" placeholder="Apellido Estudiante..."
                                required maxlength="50" id="last_name" class="form-control">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fa-solid fa-gift"></i>
                            </span>
                            <input @change="processPhoto($event)" type="file" accept="image/png, image/jpeg, image/gif"
                                class="form-control">
                        </div>

                        <div class="d-grid col-6 mx-auto mb-3">
                            <button class="btn btn-success">
                                <i class="fa-solid fa-floppy-disk button-save">
                                    Guardar
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent } from 'vue';
    import { CreateStudent } from '@/interfaces/CreateStudent';
    import { Temporal } from 'temporal-polyfill';
    import { confirmButton, constructRequest, genericRequest } from '@/utils/Helpers';
    import { InterfaceRequest } from '@/interfaces/InterfaceRequest';
    import { validateIsEmptyField } from '@/utils/Validators';
    import { showAlert } from '@/utils/Helpers';

    export default defineComponent({
        data() {
            return {
                createStudent: {
                    nombre: '',
                    apellido: '',
                    foto: '',
                } as CreateStudent,
                loaded: false,
                url: 'http://localhost:8000/api/v1/estudiantes/',
            }
        },
        methods: {
            async processPhoto(event: any) {
                try {
                    const photo = await this.getPhoto(event);
                    this.createStudent.foto = String(photo); // Convertir a string explícitamente
                    this.setPhoto(photo);
                } catch (error) {
                    console.error('Error al procesar la foto:', error);
                }
            },
            getPhoto(event: any): Promise<CreateStudent['foto']> {
                return new Promise((resolve, reject) => {
                    const file = event.target.files[0];
                    if (!file) {
                        resolve('');
                        return;
                    }
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        resolve(reader.result as string || '');
                    };
                    reader.onerror = (error) => {
                        reject(error);
                    };
                });
            },
            setPhoto(photo: CreateStudent['foto']) {
                const htmlPhoto = document.getElementById('photo') as HTMLImageElement;
                if (htmlPhoto) {
                    htmlPhoto.src = photo || '';
                }
                console.log(photo);
            },


            processCreateStudent(event: any) {
                // VALIDATE EMPTY NAME 
                if (validateIsEmptyField(this.createStudent.nombre)) {
                    showAlert('Error: Es necesario ingresar un nombre.', 'error', 'name');
                    return;
                }
                // VALIDATE EMPTY LAST NAME
                if (validateIsEmptyField(this.createStudent.apellido)) {
                    showAlert('Error: Es necesario ingresar un apellido.', 'error', 'last_name');
                    return;
                }
                // CONSTRUCT REQUEST
                const request = constructRequest(this.url, 'post', this.createStudent);

                // SEND REQUEST
                genericRequest(request);

            }
        }

    });
</script>

<style scoped>
.custom_image {
    width: 100%;
    max-width: 280px;
    display: block;
    margin: 0 auto;
    aspect-ratio: 1/1;
}

.button-save {
    letter-spacing: 0.06rem;
}
</style>