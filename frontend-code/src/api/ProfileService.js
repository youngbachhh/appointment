import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class ProfileService extends BaseService {
  constructor() {
    super('/profiles');
  }

  async getByUserId(userId) {
    try {
      return await axiosClient.get(`${this.basePath}/user/${userId}`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

}

export const profileService = new ProfileService();
