import { Header } from "@/components/header";
import { Card } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { number_format } from "@/utils/format";

type SettingProps = {
    reservation: any;
}

export default function Home({ reservation }: SettingProps) {

    return (
        <div className="w-full px-6">
            <Header title="Detail Reservation" />

            <Card>
                <Card.Header>
                </Card.Header>
                <Card.Content className="space-y-5" >
                    <div className="grid grid-cols-12 gap-4">
                        <div className="col-span-6 space-y-3">
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Customer Name</h3>
                                <p className="col-span-8 font-semibold">{reservation.user?.name}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Customer Email</h3>
                                <p className="col-span-8 font-semibold">{reservation.user?.email}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Customer Phone</h3>
                                <p className="col-span-8 font-semibold">{reservation.user?.phone}</p>
                            </div>
                        </div>
                        <div className="col-span-6 space-y-3">
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Driver Name</h3>
                                <p className="col-span-8 font-semibold">{reservation.driver?.name}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Driver Email</h3>
                                <p className="col-span-8 font-semibold">{reservation.driver?.email}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Driver Phone</h3>
                                <p className="col-span-8 font-semibold">{reservation.driver?.phone}</p>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div className="grid grid-cols-12 gap-4">
                        <div className="col-span-6 space-y-3">
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Start Point</h3>
                                <p className="col-span-8 font-semibold">{reservation.start_address}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Mid Point</h3>
                                <p className="col-span-8 font-semibold">{reservation.mid_address}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">End Point</h3>
                                <p className="col-span-8 font-semibold">{reservation.end_address}</p>
                            </div>
                        </div>
                        <div className="col-span-6 space-y-3">
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Total Price</h3>
                                <p className="col-span-8 font-semibold">Rp {number_format(reservation.total_price)}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Payment Status</h3>
                                <p className="col-span-8 font-semibold">{reservation.payment_status}</p>
                            </div>
                            <div className="grid grid-cols-12 gap-4">
                                <h3 className="col-span-4">Reservation Status</h3>
                                <p className="col-span-8 font-semibold">{reservation.status}</p>
                            </div>
                        </div>
                    </div>
                </Card.Content>
                <Card.Footer>
                </Card.Footer>
            </Card>
        </div>

    );
}

Home.layout = (page: React.ReactNode) => <AppLayout children={page} />;
