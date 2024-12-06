import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class PatientAppointmentService extends BaseService {
  constructor() {
    super('/appointments');
  }

//   async getByDepartmentId(departmentId) {
//     try {
//       return await axiosClient.get(`${this.basePath}/department/${departmentId}`);
//     } catch (error) {
//       handleApiError(error);
//       return [];
//     }
//   }

}

export const patientAppointmentService = new PatientAppointmentService();
