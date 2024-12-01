import { BaseService } from './BaseService';

class ClinicService extends BaseService {
  constructor() {
    super('/clinics');
  }
}

export const clinicService = new ClinicService();
