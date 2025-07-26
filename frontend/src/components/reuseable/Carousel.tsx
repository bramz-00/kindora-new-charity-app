import Autoplay from "embla-carousel-autoplay"
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "../ui/carousel"
import { Card, CardContent } from "../ui/card"
import { useGoodStore } from "@/store/good"
import { useEffect } from "react"
import GoodCard from "./GoodCard"

export function CarouselCard() {
    const { goods, fetchGoods, } = useGoodStore()

    useEffect(() => {
        fetchGoods()
    }, [])
    return (
        <Carousel opts={{
            align: "start",
            loop: true,
        }}
            plugins={[
                Autoplay({
                    delay: 2000,
                }),
            ]} className="w-full lg:max-w-5xl">
            <CarouselContent>
                {goods.map((good) => (
                    <CarouselItem key={good.id} className="md:basis-1/2 lg:basis-1/3">
                        <div className="p-1">
                            {/* <Card>
                                <CardContent className="flex aspect-square items-center justify-center p-6">
                                    <span className="text-3xl font-semibold">{good.title}</span>
                                </CardContent>
                            </Card> */}
                            <GoodCard good={good} />


                        </div>
                    </CarouselItem>
                ))}
            </CarouselContent>
            <CarouselPrevious />
            <CarouselNext />

        </Carousel>
    )
}