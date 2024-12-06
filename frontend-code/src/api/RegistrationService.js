import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class RegistrationService extends BaseService {
  constructor() {
    super('/registrations');
  }

  async getByClinicId(clinicId) {
    try {
      return await axiosClient.get(`${this.basePath}/clinic/${clinicId}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

}

export const registrationService = new RegistrationService();
