import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class AppointmentPaymentService extends BaseService {
  constructor() {
    super('/appointment-payments');
  }

  async getVnpay(appointmentPaymentId) {
    try {
      return await axiosClient.get(`${this.basePath}/vnpay/${appointmentPaymentId}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

}

export const appointmentPaymentService = new AppointmentPaymentService();
