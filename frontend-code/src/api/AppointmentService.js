import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class AppointmentService extends BaseService {
  constructor() {
    super('/services');
  }

  async getByDepartmentId(departmentId) {
    try {
      return await axiosClient.get(`${this.basePath}/department/${departmentId}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

}

export const appointmentService = new AppointmentService();
