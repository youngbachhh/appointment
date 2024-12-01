import { BaseService } from './BaseService';
import axiosClient from './axiosClient';
import handleApiError from './errorHandler';

class AuthService extends BaseService {
  constructor() {
    super('/auth');
  }

  async login(email, password) {
    try {
      return await axiosClient.post(`${this.basePath}/login`, { email, password });
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

  async logout() {
    try {
      return await axiosClient.get(`${this.basePath}/logout`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

  async register(data) {
    try {
      return await axiosClient.post(`${this.basePath}/register`, data);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

  async refresh() {
    try {
      return await axiosClient.get(`${this.basePath}/refresh`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }

  async respondWithToken() {
    try {
      return await axiosClient.get(`${this.basePath}/token`);
    } catch (error) {
      handleApiError(error);
      return [];
    }
  }
}

export const authService = new AuthService();
