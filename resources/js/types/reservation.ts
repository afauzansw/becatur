export type Reservation = {
    id?: number;
    user_id: number;
    driver_id?: number | null;
    start_address: string;
    start_latitude: number;
    start_longitude: number;
    mid_address?: string | null;
    mid_latitude?: number | null;
    mid_longitude?: number | null;
    end_address: string;
    end_latitude: number;
    end_longitude: number;
    total_price: string;
    status: string;
    cancelation_reason?: string | null;
    created_at?: string;
    updated_at?: string;

    user?: any;
    driver?: any;
}
