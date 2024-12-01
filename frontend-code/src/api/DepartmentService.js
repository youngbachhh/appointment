import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class DepartmentService extends BaseService {
  constructor() {
    super('/departments');
  }

  async getByRegistrationId(registrationId) {
    try {
      return await axiosClient.get(`${this.basePath}/registration/${registrationId}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

}

export const departmentService = new DepartmentService();
